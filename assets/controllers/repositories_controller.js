import { Controller } from '@hotwired/stimulus';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* sti mul usF etch: 'la zy' */
export default class extends Controller {
  static targets = ['address']





  /**
   *  function toggleAddress
   */


  toggle(event) {

    console.log('Target: ', event.target);
    console.log('Attributes: ', event.target.classList);


    if (this.hasAddressTarget) {
      if (event.target.classList.contains('active'))
        this.addressTarget.classList.remove('d-none');
      else
        this.addressTarget.classList.add('d-none');
    }
    console.log('Toggle address');
  }

}
