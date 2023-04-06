// assets/controllers/gedcom-controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static targets = ['polyview', 'holger', 'spinner']



  // import())
  // - importerer en ny GEDCOM fil

  import(event) {
    console.log('Import called now...')
    var file = event.target.files[0];
    console.log('Filename: ', file.name);
    console.log('Filesize: ', file.size);
    console.log('Filetype: ', file.type);
    var reader = new FileReader();
    var that = this;

    // filereader.error

    reader.onerror = function (e) {
      console.log("Unable ro read file");
    }

    // filereader.onload
    //
    // Validerer at første linie er '0 HEAD'

    reader.onload = function (e) {

      const eol = /[\r\n]+/g;
      const mstr = /^(\d|[1 - 9]\d)(?:\x20@([0-9a-zA-z]{1,20})@)?\x20(\w{1,31})(?:\x20@([0-9a-zA-z]{1,20})@)?(?:\x20@#([a-zA-Z][a-zA-Z\x20]{1,20})@)?(?:\x20(.*))?/;

      console.log('Loaded')
      var text = e.target.result;

      const result = /^0 HEAD/.test(text);

      console.log('Result: ', result);

      //console.log('ClassName: ', that.spinnerTarget.className)

      if (that.hasHolgerTarget) {
        //that.holgerTarget.innerText= JSON.stringify(text.split(/[\r\n]+/g));
        //that.holgerTarget.innerText = text.split(/[\r\n]+/g);
        //that.holgerTarget.innerText = text;
        console.log('** Tester **');
        console.log(that.holgerTarget.textContent);
        console.log('** Tester **');
        that.holgerTarget.textContent = text;
        console.log(that.holgerTarget.textContent);
        console.log('** Tester **');
      }
      else
        console.log("Target not found");

      var lines = text.split(eol).map(function (str) { return str.match(mstr) }); // tolerate both Windows and Unix linebreaks

      console.log('Line: ', lines[0]);
      //console.log(lines);
      console.table(lines);
    }

    //  filereader.onloadend
    //  - fjerner spinner igen

    reader.onloadend = function (e) {
      that.spinnerTarget.className = "invisible";
      console.log('ClassName: ', that.spinnerTarget.className)

    }


    // filereader.onloadstart

    reader.onloadstart = function (e) {
      // TODO: Tilføj spinner
      that.holgerTarget.textContent = "";
      that.spinnerTarget.className = "visible";
      console.log('ClassName: ', that.spinnerTarget.className)


      //that.holgerTarget.value = "";
    }

    // filereader.onprogress

    reader.onprogress = function (e) {
      console.log("Progress", e);
    }

    console.log('Read file');
    reader.readAsText(file, 'latin1');

    if (this.hasHolgerTarget)
      console.log("YES !");

  }


  // submit()

  submit(event) {
    console.log("Submit called...")
    //this.holgerTarget.value = "** Hello There **"
  }

}