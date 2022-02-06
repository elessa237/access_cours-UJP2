import {unmountComponentAtNode, render} from "react-dom";
import React from "react";
import Setting from "../profil/settings/Setting";

class settingsElement extends HTMLElement
{
    connectedCallback(){
        let id = parseInt(this.getAttribute("id"), 10);
        render(<Setting id={id}/>, this)
    }

    disconnectedCallback(){
        unmountComponentAtNode(this);
    }
}

export default settingsElement