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

// assets/controllers/snippet-controller.js

import { Controller } from '@hotwired/stimulus';


export default class extends Controller
{

  select(event)
  {
    console.log('Snippet click');
    event.currentTarget.classList.toggle('table-active');
  }
}