import { Controller } from '@hotwired/stimulus';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static targets = ['content']
  static values = { url: String, }

  /**
   * refreshContent()
   * - Generisk function til reload af controllere
   * 
   * @param {*} event 
   */

  async refreshContent(event) {
    const myInit = {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      //body: JSON.stringify(value),
      mode: 'cors',
      credentials: 'include',
    };

    console.time('render1');
    await fetch(this.urlValue, myInit)
      .finally(() => {
        console.timeEnd('render1');
      })
      .then((response) => response.text())
      .then((data) => this.contentTarget.innerHTML = data)
      .catch((error) => {
        console.error('Catch Error: ', error)
      });

  }

}
