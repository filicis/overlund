// assets/controllers/editor-controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static values= {
    project: String,
    indi: String,
    fam: String
  }
  static targets= ['indiView', 'famView']


  // indiValueChanged()
  // - opdaterer 
  //
  indiValueChanged() 
  {
    //fetch(this.urlValue).then(/* … */)
  }


  // famValueChanged()
  // - opdaterer
  //
  famValueChanged() 
  {
    //fetch(this.urlValue).then(/* … */)
  }


  // updateSex()
  //
  //
  updateSex(event) 
  {
     document.getElementById("birger").classList.remove('bg-primary', 'bg-secondary', 'bg-danger', 'bg-alarm');
       switch (event.target.value)
       {
         case 'M':
           document.getElementById("birger").classList.add("bg-primary");
           // document.getElementById("birger").style.backgroundColor= tomato;
           break;
         case 'F':
           document.getElementById("birger").classList.add("bg-danger");
           break;
         case 'U':
         case 'N':
           document.getElementById("birger").classList.add("bg-secondary");
           break;
         default:
           document.getElementById("birger").classList.add("bg-alarm");
       }
  }
}
