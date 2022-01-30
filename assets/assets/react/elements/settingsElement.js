import {unmountComponentAtNode, render} from "react-dom";
import React from "react";
import Setting from "../profil/settings/Setting";

class settingsElement extends HTMLElement
{
    connectedCallback(){
        render(<Setting />, this)
    }

    disconnectedCallback(){
        unmountComponentAtNode(this);
    }
}

export default settingsElement