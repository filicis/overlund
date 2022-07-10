// assets/controllers/editor-controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static values= {
    project: String,
    indi: String,
    fam: String,
    renderindi: String,
    renderfam: String,
  }
  static targets= ['indiView', 'famView', 'indicard']



  // indiValueChanged()
  // - opdaterer
  //
  indiValueChanged(value)
  {
    const myInit= {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(value),
      mode: 'cors',
      credentials: 'include',
    };

    fetch(this.renderindiValue, myInit)
      .then(response => response.text())
      .then(data => this.indiViewTarget.innerHTML= data)
      .catch();
  }


  // famValueChanged()
  // - opdaterer
  //
  famValueChanged(value)
  {
    const myInit= {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(value),
      mode: 'cors',
      credentials: 'include',
    };

    fetch(this.renderfamValue, myInit)
      .then(response => response.text())
      .then(data => this.famViewTarget.innerHTML= data)
      .catch();
  }



  //
  //
  //
  newFamily(event)
  {
    const myInit= {
      mode: 'cors',
      credentials: 'include',
    };

    fetch(event.params.myurl, myInit)
      .then(response => response.text())
      .then(data => console.log(data));
      //.then(data => this.famValue= data['idd']);
      //.catch();
  }


  //  newIndividual
  //
  //
  newIndividual(event)
  {

    const myInit= {
      mode: 'cors',
      credentials: 'include',
    };

    fetch(event.params.myurl, myInit)
      .then(response => response.json())
      .then(data => this.indiValue= data['id'])
      .catch();
  }




  // updateSex()
  //
  //
  updateSex(event)
  {
    if (this.hasIndicardTarget)
    {
       this.indicardTarget.classList.remove('alert-info', 'alert-primary', 'alert-secondary', 'alert-danger', 'alert-warning');
       switch (event.target.value)
       {
         case 'M':
           this.indicardTarget.classList.add("alert-info");
           break;
         case 'F':
           this.indicardTarget.classList.add("alert-danger");
           break;
         case 'U':
         case 'N':
           this.indicardTarget.classList.add("alert-secondary");
           break;
         default:
           this.indicardTarget.classList.add("alert-primary");
       }
    }
  }
}
