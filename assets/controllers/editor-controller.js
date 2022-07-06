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

  //
  //
  //
  addFamily(event)
  {
  }


  //
  //
  //
  addIndividual(event)
  {

    const myInit= {
      mode: 'cors',
      credentials: 'include',
    };

    fetch(event.params.myurl, myInit)
      .then(response => {
        //handle response
        // alert("HTTP Error !");
        console.log(response);
      })
      .then(data => {
        //handle data
        console.log(data);
      })
      .catch(error => {
        //handle error
      });

    document.getElementById('idYYY0').value= event.params.myurl;

  }


  // updateSex()
  //
  //
  updateSex(event)
  {
     document.getElementById("birger").classList.remove('alert-primary', 'alert-secondary', 'alert-danger', 'alert-alarm');
       switch (event.target.value)
       {
         case 'M':
           document.getElementById("birger").classList.add("alert-primary");
           // document.getElementById("birger").style.backgroundColor= tomato;
           break;
         case 'F':
           document.getElementById("birger").classList.add("alert-danger");
           break;
         case 'U':
         case 'N':
           document.getElementById("birger").classList.add("alert-secondary");
           break;
         default:
           document.getElementById("birger").classList.add("alert-alarm");
       }
  }
}
