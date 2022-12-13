import { Controller } from '@hotwired/stimulus';

/**
 * This file is part of the Overlund package.
 *
 * @author Michael Lindhardt Rasmussen <filicis@gmail.com>
 * @copyright 2000-2022 Filicis Software
 * @license MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// assets/controllers/reload-content_controller.js



/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulus Fetch: 'la zy' */
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

    console.log('Parameters: ', event.params);
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

  flash(event) {
    console.error('**** SUCCESS ****');
  }


}
