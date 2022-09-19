// assets/controllers/gedcom-controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static targets= [ 'polyview', 'holger', ]


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

    reader.onload= function(e)
    {
      console.log('Loaded')
      var text= e.target.result;

      const result= /^0 HEAD/.test(text);

      console.log('Result: ', result);

      const result1= /0 TRLR/.test(text);

      console.log('Result1: ', result1);


      if (that.hasHolgerTarget)
      {
        that.holgerTarget.value= text;
      }
      else
        console.log("Target not found");
      var lines= text.split(/[\r\n]+/g); // tolerate both Windows and Unix linebreaks
      console.log('Line: ', lines[0]);
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