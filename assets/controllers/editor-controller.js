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
  static targets= ['indiView', 'famView', 'indicard', 'personalName']


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
    reader.onload= function(e)
    {
      console.log('Loaded')
      var text= e.target.result;
      var lines= text.split(/[\r\n]+/g); // tolerate both Windows and Unix linebreaks
      console.log('Line: ', lines[0]);
    }
    console.log('Read file');
    reader.readAsText(file);
  }


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



  //  famRestrictions()

  famRestrictions(event)
  {
    console.log('Name: ', event.target.name);
    console.log('Checked: ', event.target.checked);
    switch(event.target.name)
    {
      case 'locked':
        break;

      case 'confidential':
        break;

      case 'privacy':
        break;
    }

  }



  //  indiRestrictions()

  indiRestrictions(event)
  {
    console.log('Name: ', event.target.name);
    console.log('Checked: ', event.target.checked);
    switch(event.target.name)
    {
      case 'locked':
        break;

      case 'confidential':
        break;

      case 'privacy':
        break;
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



  //  function updatePersonalNameStructurre
  //
  //  event.params
  //  url:
  //  indiId:
  //  nameId:

  updatePersonalNameStructure(event)
  {
    const property= event.target.attributes.name.value;
    var arg= {};
    arg[property]= event.target.value;
    arg['nameId']= event.params['nameId'];
    arg['indiId']= this.indiValue;


    const myInit= {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(arg),
      mode: 'cors',
      credentials: 'include',
    };

    fetch(event.params['url'], myInit)
    .then((response) => {
        if (! response.ok)
          throw new Error('Netværksfejl: ', response.status);
        return response.text();
    })
    .then((data) => {
        console.log('Data: ', data);
    })
    .catch((error) => console.error('Error: ', error));
  }




  // updateSex()
  //
  //
  updateSex(event)
  {
    if (this.hasIndicardTarget)
    {
      switch (event.target.value)
      {
        case 'M':
          this.indicardTarget.style.backgroundColor= "#DBFFFE";
          break;
        case 'F':
          this.indicardTarget.style.backgroundColor= "#FFF2F2";
          break;
        case 'U':
        case 'N':
          this.indicardTarget.style.backgroundColor= "#F0FFEF";
          break;
        default:
          this.indicardTarget.style.backgroundColor= "#F0FFEF";
      }
    }
    event.stopPropagation();
  }
}
