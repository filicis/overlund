// assets/controllers/gedcom-controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static targets= [ 'polyview', 'holger', 'spinner']


  // import())
  // - importerer en ny GEDCOM fil

  import(event)
  {
    console.log('Import called now...')
    var file= event.target.files[0];
    console.log('Filename: ', file.name);
    console.log('Filesize: ', file.size);
    console.log('Filetype: ', file.type);
    var reader= new FileReader();
    var that= this;

      // filereader.error

    reader.onerror= function(e)
    {
      console.log("Unable ro read file");
    }

      // filereader.onload
      //
      // Validerer at første linie er '0 HEAD'

    reader.onload= function(e)
    {
      console.log('Loaded')
      var text= e.target.result;

      const result= /^0 HEAD/.test(text);

      console.log('Result: ', result);

      console.log('ClassName: ', that.spinnerTarget.className)

      if (that.hasHolgerTarget)
      {
        that.holgerTarget.value= text;
      }
      else
        console.log("Target not found");
      var lines= text.split(/[\r\n]+/g); // tolerate both Windows and Unix linebreaks
      console.log('Line: ', lines[0]);
    }

      //  filereader.onloadend
      //  - fjerner spinner igen

    reader.onloadend= function(e)
    {
      that.spinnerTarget.className= "invisible";
    }


      // filereader.onloadstart

    reader.onloadstart= function(e)
    {
      // TODO: Tilføj spinner
      that.spinnerTarget.className= "visible";
      console.log('ClassName: ', that.spinnerTarget.className)


      that.holgerTarget.value= "";
    }

      // filereader.onprogress

    reader.onprogress= function(e)
    {
      console.log("Progress");
    }

    console.log('Read file');
    reader.readAsText(file);

    if (this.hasHolgerTarget)
      console.log("YES !");

  }
}