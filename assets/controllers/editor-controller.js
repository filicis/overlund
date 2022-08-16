// assets/controllers/editor-controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static values= {
    project: String,
    indi: String,
    fam: String,
    husband: String,
    wife: String,
    renderindi: String,
    renderfam: String,
  }
  static targets= ['indiView', 'famView', 'indicard']



  // indiValueChanged()
  // - opdaterer
  //
  indiValueChanged(value, previousValue)
  {
    if (! (value === previousValue))
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
  }


  // function famValueChanged()
  // - opdaterer
  //
  famValueChanged(value, previousValue)
  {
    if (! (value === previousValue))
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
  }



  // function newFamily
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


  //  function newIndividual
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


  // function selectHusband
  //
  //

  selectHusband(event)
  {
    this.indiValue= this.husbandValue;
    event.stopPropagation();
  }


  // function selectWife
  //
  //

  selectWife(event)
  {
    this.indiValue= this.wifeValue;
    event.stopPropagation();
  }


  // function unlinkHusband
  //
  //

  unlinkHusband(event)
  {
    this.husbandValue== "";
    event.stopPropagation();
  }


  // function unlinkWife
  //
  //

  unlinkWife(event)
  {
    this.wifeValue= "";
    event.stopPropagation();
  }


  //
  //
  // updatePerosnalNameStructurre

  updatePersonalNameStructure(event)
  {
    return;
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
    event.stopPropagation();
  }
}
