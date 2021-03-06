import React from 'react';
import PageHeader from "./_PageHeader";
import GeneralSetting from "./_GeneralSetting";
import EmailPassword from "./_Email&Password";
import DeleteAccount from "./_DeleteAccount";
import {ToastContainer} from "react-toastify";

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
function Setting({id}) {
    return (
        <div className="container-fluid px-6 py-4">
            <PageHeader />
            <GeneralSetting id={id}/>
            <EmailPassword id={id}/>
            <DeleteAccount />
            <ToastContainer/>
        </div>
    );
}

export default Setting;