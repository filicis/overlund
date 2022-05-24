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



    // document.getElementById('idYYY0').value= 'Test06';

          // (A) FETCH "DUMMY.HTML"

      fetch(event.params.myurl, myInit);

          // (B) RETURN THE RESULT AS TEXT
          //.then((result) => {
          //  if (result.status != 200) { throw new Error("Bad Server Response"); }
          //  return result.text();
          //})

          // (C) PUT LOADED CONTENT INTO <DIV>
          //.then((content) => {
          //  document.getElementById("villy").innerHTML = content;
          //})

          // (D) HANDLE ERRORS - OPTIONAL
          //.catch((error) => { console.log(error); });

    document.getElementById('idYYY0').value= event.params.myurl;

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
