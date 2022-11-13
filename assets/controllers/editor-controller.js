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
    webapi: String,
  }
  static targets= ['indiView', 'famView', 'indicard', 'personalName', 'tommy']

  //var myResult;

  //  function #webapi
  //  - Den primære indgang til systemets web service
  //

  async #webapi(arg, mymethod= 'PUT')
  {
    var myResult= "Hej verden";
    const myInit= {
      mode: 'cors',
      credentials: 'include',
      method: mymethod,
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(arg),
    };

    console.log('Arg: ', arg);
    console.log('myInit: ', myInit)
    await fetch(this.webapiValue, myInit)
    .then((response) =>
    {
      if (! response.ok)
      {
        switch(response.status)
        {
          case 503:
            window.location.href = "/offline";
            throw new Error('System is offline');

          default:
        }
        window.location.href = "/";
        throw new Error('Netværksfejl: ', response.status);
      }

      console.log('#webapi content-type: ' , response.headers.get('Content-Type'));

      return (response.headers.get('Content-Type') == 'application/json')  ? response.json() : response.text();
    })
    .then((data) =>
    {
      myResult= data;

    })
    .catch((error) =>
    {
      console.error('Catch Error: ', error.message);
    });
    return myResult;
  }



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

      console.time('render');
      fetch(this.renderindiValue, myInit)
      .finally(() =>
      {
        console.timeEnd('render');
      })
      .then((response) => response.text())
      .then((data) => this.indiViewTarget.innerHTML= data)
      .catch((error) =>
      {
      console.error('Catch Error: ', error)
      });
    }
  }



  //  restrictions()

  restrictions(event)
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

      console.time('render');
      fetch(this.renderfamValue, myInit)
      .finally(() =>
      {
        console.timeEnd('render');
      })
      .then((response) => response.text())
      .then((data) => this.famViewTarget.innerHTML= data)
      .catch((error) =>
      {
        console.error('Catch Error: ', error)
      });
    }


  }

  /**
   *  function individualNames
   *  - Åbner et modalt vindue til redigering af et givent individs navne
   *
   *  - Individdet er allerede defineret i this.indi
   */

  individualNames(event)
  {

    console.log("individualNames");

    const myModal = new bootstrap.Modal(document.getElementById('mlrModal'), {'focus': true});

    myModal.show();
    console.log("individualNames: ", myModal);



  }



  // function newFamily
  //
  //
  newFamily(event)
  {
    var arg= {};
    arg['method']= "api_family_new";
    arg['project']= 'Project01';

    this.#webapi(arg)
    .then((data) =>
    {
      console.log('newFamily Result: ', data);
      console.log('newFamily Result: ', data.stat);

      if (data.stat == 'Ok')
        this.famValue= data.result.id;
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

    this.#webapi(arg)
    .then((data) =>
    {
      console.log('newIndividual Result: ', data);
      console.log('newIndividual Result: ', data.stat);

      if (data.stat == 'Ok')
        this.indiValue= data.result.id;
    });
  }


  // function selectHusband
  //
  //

  selectIndividual(event)
  {
    console.log("SelectIndividual: ", event);
    console.log("SelectIndividual id: ", event.params.id);
    this.indiValue= event.params.id;
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
  //
  //  TODO: Skal opdatere navn relevante steder på websiden

  updatePersonalNameStructure(event)
  {
    const property= event.target.attributes.name.value;

    var that= this;

    var arg= {};
    arg[property]= event.target.value;
    arg['method']= "api_individual_updatePersonalNames";
    arg['project']= 'Project01';
    arg['nameId']= event.params['nameId'];
    arg['indiId']= this.indiValue;

    this.#webapi(arg)
    .then((data) =>
    {
        console.log('Result: ', data);

        let cmd= "[title='".concat(that.indiValue, "']");
        // console.log("Cmd: ", cmd);
        // let nodes= document.querySelectorAll("span[title='01GEN5HWT6ANXP0X5K22WSPTW9']");
        let nodes= document.querySelectorAll(cmd);

        nodes.forEach((element) =>
        {
          element.innerText= data.result.name;
        });
        // console.log("Nodes: ", nodes);
    });
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
    var arg= {};
    arg['method']= "api_family_newAsChild";
    arg['project']= 'Project01';
    console.log('Called: newAsChild');
    return this.#webapi(arg);
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


  /**
   *  loaderrer
   *
   *  TODO: skal slette alle <source> elementer...
   */

  loaderror(event)
  {
    console.log('Load Error: !!', event.target.src);
    console.log('Load Error: !!', event.currentTarget.parentNode.children[0]);
    console.log('Load Error: !!', event.currentTarget.parentNode.children[1]);
    console.log('Load Error: !!', event.currentTarget.parentNode);

  }




  /**
   *  function individualEvetns(event)
   *
   *
   */

  individualEvents(Event)
  {
    console.log("individualEvents");

    //document.get.modal('show');

    const myModal = new bootstrap.Modal(document.getElementById('mlrModalEvent'), {'focus': true});

    //const myModal = new bootstrap.Modal(ElementById('exampleModal')document.get);
    myModal.show();
    console.log("individualEvents: ", myModal);

  }


  /**
   *  function notes(event)
   *
   *
   */

  notes(Event)
  {
    console.log("notes");
    const myModal = new bootstrap.Modal(document.getElementById('mlrModalNoteEditor'), {'focus': true});
    myModal.show();
    console.log("individualEvents: ", myModal);
  }


  /**
   *  function sourceCitations(event)
   *
   *
   */

  sourceCitations(Event)
  {
    console.log("sourceCitations");
    const myModal = new bootstrap.Modal(document.getElementById('mlrModalSourceRecord'), {focus: true});
    myModal.show();
    console.log("individualEvents: ", myModal);
  }


  /**
   *  function mediaFiles(event)
   *
   *
   */

  mediaFiles(Event)
  {
    console.log("mediafiles");
    const myModal = new bootstrap.Modal(document.getElementById('mlrModal'), {focus: true});
    console.log("individualEvents: ", myModal);
  }


  /**
   *  function alias(event)
   *
   *
   */

  alias(Event)
  {
    console.log("alias");
    alert("Alias");
  }


  /**
   *  function associates(event)
   *
   *
   */

  associates(Event)
  {
    console.log("Associates");
    alert("Associates");
  }

  /**
   *  function librarySourceRecords(event)
   *
   *
   */

  librarySourceRecords(Event)
  {
    console.log("Library - Source Records");

    const myModal = new bootstrap.Modal(document.getElementById('modalSourceLibrary'), {'focus': true});

    myModal.show();

    //alert("Source Records");
  }


  /**
   *  function libraryRepositoryRecords(event)
   *
   *
   */

  libraryRepositoryRecords(Event)
  {
    console.log("Library - Repository Records");

    const myModal = new bootstrap.Modal(document.getElementById('modalRepositoryLibrary'), {'focus': true});

    myModal.show();

    //alert("Source Records");
  }


  /**
   *  function libraryNoteRecords(event)
   *
   *
   */

  libraryNoteRecords(Event)
  {
    console.log("Library - Note Records");

    const myModal = new bootstrap.Modal(document.getElementById('modalNoteLibrary'));

    myModal.show();

    //alert("Source Records");
  }


  /**
   *  function libraryMediaRecords(event)
   *
   *
   */

  libraryMediaRecords(Event)
  {
    console.log("Library - Media Records");

    const myModal = new bootstrap.Modal(document.getElementById('modalMediaLibrary'));

    myModal.show();

    //alert("Source Records");
  }


  /**
   *  function libraryPlaceRecords(event)
   *
   *
   */

  libraryPlaceRecords(Event)
  {
    console.log("Library - Place Records");

    const myModal = new bootstrap.Modal(document.getElementById('modalPlaceLibrary'));

    myModal.show();

    //alert("Source Records");
  }



  /**
   *  function libraryIndividualRecords(event)
   *
   *
   */

  libraryIndividualRecords(Event)
  {
    console.log("Library - Individual Records");

    const myModal = new bootstrap.Modal(document.getElementById('modalIndividualLibrary'));

    myModal.show();

    //alert("Source Records");
  }



  /**
   *  function libraryFamilyRecords(event)
   *
   *
   */

  libraryFamilyRecords(Event)
  {
    console.log("Library - Family Records");

    const myModal = new bootstrap.Modal(document.getElementById('modalFamilyLibrary'));

    myModal.show();

    //alert("Source Records");
  }



  dummy(event)
  {
    console.log("Dummy: ", event);
    //alert("Click !");

  }


}
