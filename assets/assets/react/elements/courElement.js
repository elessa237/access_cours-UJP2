import React from 'react';
import {render, unmountComponentAtNode} from 'react-dom';
import Cour from '../cour/Cour';

class courElement extends HTMLElement{
    connectedCallback(){
        render(<Cour />, this)
    }

    disconnectedCallback(){
        unmountComponentAtNode(this);
    }
}

export default courElement;