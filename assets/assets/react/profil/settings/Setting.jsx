import React from 'react';
import PageHeader from "./_PageHeader";
import GeneralSetting from "./_GeneralSetting";
import EmailPassword from "./_Email&Password";
import DeleteAccount from "./_DeleteAccount";

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
        </div>
    );
}

export default Setting;