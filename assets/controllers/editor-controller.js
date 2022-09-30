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
    webapi: String
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
    var arg= {};
    arg['method']= "api_family_new";
    arg['project']= 'Project01';
    const myInit= {
      mode: 'cors',
      credentials: 'include',
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(arg),
    };

    //fetch(event.params.myurl, myInit)
    fetch(this.webapiValue, myInit)
    .then((response) =>
    {
      return response.json()
    })
    .then((data) =>
    {
      console.log(data);
      const res= data.result;
      this.famValue= res.id;
      console.log('Id: ', res.id);
    })
    //.then(data => this.famValue= data['idd']);
    //.catch();
    .catch(error =>
    {
      console.error('Error: ', error)
    });
  }


  //  function newIndividual
  //
  //

  newIndividual(event)
  {
    var arg= {};
    arg['method']= "api_individual_new";
    arg['project']= 'Project01';
    const myInit= {
      mode: 'cors',
      credentials: 'include',
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(arg),
    };

    fetch(this.webapiValue, myInit)
    .then((response) =>
    {
      if (! response.ok)
        throw new Error('Netværksfejl: ', response.status);
      console.log('Response OK');
      return response.json();
    })
    .then((data) =>
    {
      console.log(data);

      const res= data.result;
      this.indiValue= res.id;
      console.log('Id: ', res.id);
    })
    .catch(error =>
    {
      console.error('Error: ', error)
    });

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


  // function unlinkChild
  //
  //

  unlinkChild(event)
  {
    console.log('Called: unlinkChild');
  }

  // function unlinkHusband
  //
  //

  unlinkHusband(event)
  {
    console.log('Called: unlinkHusband');
    this.husbandValue== "";
    event.stopPropagation();
  }


  // function unlinkWife
  //
  //

  unlinkWife(event)
  {
    console.log('Called: unlinkWife');
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
    const myurl= this.webapiValue + "/" + "api_individual_updatePersonalName" + "/Project01";

    var arg= {};
    arg[property]= event.target.value;
    arg['method']= "api_individual_updatePersonalName";
    arg['project']= 'Project01';
    arg['nameId']= event.params['nameId'];
    arg['indiId']= this.indiValue;


    const myInit= {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(arg),
      mode: 'cors',
      credentials: 'include',
    };

    console.log('Webapi: ', this.webapiValue);
    console.log('Myulr: ', myurl);
    //fetch(event.params['url'], myInit)
    // fetch(myurl, myInit)
    fetch(this.webapiValue, myInit)
    .then((response) => {
        if (! response.ok)
          throw new Error('Netværksfejl: ', response.status);
        return response.text();
    })
    .then((data) => {
        console.log('Data::: ', data);
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


  /*
   *  newAsHusband(event)
  */

  newAsHusband(event)
  {
    console.log('Called: newAsHusband');
  }


  /*
   *  newAsChild(event)
  */

  newAsChild(event)
  {
    console.log('Called: newAsChild');
  }


  /*
   *  newAsWife(event)
  */

  newAsWife(event)
  {
    console.log('Called: newAsWife');
  }


  /*
   *  linkAsChild(event)
  */

  linkAsChild(event)
  {
    console.log('Called: linkAsChild');
  }

  /*
   *  linkAsHusband(event)
  */

  linkAsHusband(event)
  {
    console.log('Called: linkAsHusband');
  }


  /*
   *  linkAsWife(event)
  */

  linkAsWife(event)
  {
    console.log('Called: linkAsWife');
  }


  /*
   *  searchForChild(event)
  */

  searchForChild(event)
  {
    console.log('Called: searchForChild');
  }

  /*
   *  searchForHusband(event)
  */

  searchForHusband(event)
  {
    console.log('Called: searchForHusband');
  }


  /*
   *  searchForWife(event)
  */

  searchForWife(event)
  {
    console.log('Called: searchForWife');
  }


  /*
   *  notesForChild(event)
  */

  notesForChild(event)
  {
    console.log('Called: notesForChild');
  }




  /*
   *  notesForHusband(event)
  */

  notesForHusband(event)
  {
    console.log('Called: notesForHusband');
  }


  /*
   *  notesForWife(event)
  */

  notesForWife(event)
  {
    console.log('Called: notesForWife');
  }


  /*
   *  pedigreeOfChild(event)
  */

  pedigreeOfChild(event)
  {
    console.log('Called: pedigreeOfChild');
  }


  /*
   *  moveChildUp(event)
  */

  moveChildUp(event)
  {
    console.log('Called: moveChildUp');
  }


  /*
   *  moveChildDown(event)
  */

  moveChildDown(event)
  {
    console.log('Called: moveChildDown');
  }




}
