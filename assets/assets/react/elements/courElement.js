import React from 'react';
import {render, unmountComponentAtNode} from 'react-dom';
import Cour from '../cour/Cour';

class courElement extends HTMLElement{
    connectedCallback(){
        const user = this.getAttribute('data-user');

        render(<Cour user={user}/>, this)
    }

    disconnectedCallback(){
        unmountComponentAtNode(this);
    }
}

export default courElement;