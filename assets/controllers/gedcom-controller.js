/**
 * This file is part of the Overlund package.
 *
 * @author Michael Lindhardt Rasmussen <filicis@gmail.com>
 * @copyright 2000-2023 Filicis Software
 * @license MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *  gedcom-controller.js 
 * 
 * 
 */

// assets/controllers/gedcom-controller.js
import { Controller } from '@hotwired/stimulus';
//import { ulid } from 'ulid';

export default class extends Controller {
  static targets = ['polyview', 'holger', 'spinner', 'textarea', 'select', 'input'];




  // import())
  // - importerer en ny GEDCOM fil

  import(event) {
    console.log('Import called now...')
    console.log("Ulid: ", ULID.ulid());
    // var file = event.target.files[0];


    // Henter aktuelle encoding

    var enc = this.selectTarget.selectedOptions[0].value;
    console.log('Enc: ', enc);

    var file = this.inputTarget.files[0];
    if (file == null)
      return;
    console.log('Filename: ', file.name);
    console.log('Filesize: ', file.size);
    console.log('Filetype: ', file.type);

    var reader = new FileReader();
    var that = this;

    // filereader.error
    //
    //

    reader.onerror = function (e) {
      console.log("Unable ro read file", e);
    }

    // filereader.onload
    //
    // Validerer at første linie er '0 HEAD' og at der findes en trailer '0 TRLR'

    reader.onload = function (e) {

      const eol = /[\r\n]+/g;
      const mstr = /^(\d|[1 - 9]\d)(?:\x20@([0-9a-zA-z]{1,20})@)?\x20(\w{1,31})(?:\x20@([0-9a-zA-z]{1,20})@)?(?:\x20@#([a-zA-Z][a-zA-Z\x20]{1,20})@)?(?:\x20(.*))?/;

      console.log('Loaded')
      var text = e.target.result;

      const result = /^0 HEAD/.test(text);
      console.log('HEAD: ', result);

      const result1 = /[\r\n]0 TRLR/.test(text);
      console.log('TRLR: ', result1);





      if (that.hasTextareaTarget) {
        that.textareaTarget.textContent = text;
      }
      else
        console.log("Target not found");

      const arr1 = ["Cecilie", null, "Project"];
      const level = [];
      //var lines = text.split(eol).map(function (str) { return str.match(mstr) }); // tolerate both Windows and Unix linebreaks
      //var lines = that.textareaTarget.textContent.split(eol).map(function (str) { const arr1 = [ULID.ulid(), "", "Project"]; const arr2 = str.match(mstr); if (arr2) { const i = arr2[1]; level[i] = arr1[0]; if (i > 0) arr1[1] = level[(i - 1)] } return arr1.concat(arr2) }); // tolerate both Windows and Unix linebreaks

      var lines = text.split(eol).map(function (str) { const arr1 = [ULID.ulid(), "", "Project"]; const arr2 = str.match(mstr); if (arr2) { const i = arr2[1]; level[i] = arr1[0]; if (i > 0) arr1[1] = level[(i - 1)] } return arr1.concat(arr2) }); // tolerate both Windows and Unix linebreaks

      window.localStorage.setItem('gedcom', lines);

      //var lines = that.textareaTarget.textContent.split(eol).map(function (str) { const arr1 = [ULID.ulid(), "Lone"]; const arr2 = str.match(mstr); level[arr2[1]] = arr1[0]; return arr1.concat(arr2) }); // tolerate both Windows and Unix linebreaks

      //that.textareaTarget.textContent = Object.entries(lines);

      console.log('Line: ', JSON.stringify(lines));
      console.log('Level: ', level);
      console.table(lines);
    }

    //  filereader.onloadend
    //
    //  - fjerner spinner igen

    reader.onloadend = function (e) {
      that.spinnerTarget.className = "invisible";
      console.log('ClassName: ', that.spinnerTarget.className)

    }


    // filereader.onloadstart
    //
    //

    reader.onloadstart = function (e) {
      that.textareaTarget.textContent = "";
      that.spinnerTarget.className = "visible";
      console.log('ClassName: ', that.spinnerTarget.className)


      //that.holgerTarget.value = "";
    }

    // filereader.onprogress
    //
    //

    reader.onprogress = function (e) {
      console.log("Progress", e);
    }


    console.log('Read file');
    reader.readAsText(file, enc);

  }


  // submit()

  submit(event) {
    console.log("Submit called...")
    //this.holgerTarget.value = "** Hello There **"
  }

}