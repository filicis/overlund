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

export default class extends Controller {
  static targets = ['polyview', 'holger', 'spinner', 'textarea', 'select', 'input'];




  // load())
  // - Indlæser en local GEDCOM fil fra brugerens computer til browseren

  load(event) {
    console.log('Loading GEDCOM file to browser...')

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
      console.log("Unable to read file", e);
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

      const mstr1 = /[\r\n]0 TRLR[\r\n]|$/g;
      const result1 = mstr1.test(text);
      console.log('TRLR: ', result1);
      console.table(mstr1);
      console.log("lastIndex: ", mstr1.lastIndex)


      //const mstr2 = /^(0[\s\S]*[\r\n]0 TRLR)/;
      const l = mstr1.lastIndex;

      console.log('l: ', l);
      //console.log('l: ', l.isInteger());


      const result2 = text.slice(0, l);
      console.log("Trim: ", result2);

      // Fremviser GEDCOM filen i preview
      //
      // - OBS: En noget tidskrævende process for større filer

      that.textareaTarget.textContent = result2;

      const arr1 = ["Cecilie", null, "Project"];
      const level = [];


      // var lines = text.split(eol).map(function (str) { const arr1 = [ULID.ulid(), "", "Project"]; const arr2 = str.match(mstr); if (arr2) { const i = arr2[1]; level[i] = arr1[0]; if (i > 0) arr1[1] = level[(i - 1)] } return arr1.concat(arr2) }); // tolerate both Windows and Unix linebreaks

      //window.localStorage.setItem('gedcom', lines);


      //console.log('Line: ', JSON.stringify(lines));
      //console.log('Level: ', level);
      //console.table(lines);
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


    // console.log('Read file');
    reader.readAsText(file, enc);

  }


  // submit()

  submit(event) {
    console.log("Submit called...")
    //this.holgerTarget.value = "** Hello There **"
  }

}