import React from 'react';

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
function DeleteAccount() {
    return (
        <div className="row">
            <div className="col-xl-3 col-lg-4 col-md-12 col-12">
                <div className="mb-4 mb-lg-0">
                    <h4 className="mb-1">Supprimer le compte</h4>
                    <p className="mb-0 fs-5 text-muted">Cette operation est irreversible</p>
                </div>
            </div>
            <div className="col-xl-9 col-lg-8 col-md-12 col-12">
                <div className="card mb-6">
                    <div className="card-body">
                        <div className="mb-6">
                            <h4 className="mb-1">Zone dangereuse </h4>
                        </div>
                        <div>
                            <p>Toutes vos information de compte seront complètement effacé.</p>
                            <a href="#" className="btn btn-danger">Supprimer le compte</a>
                            <p className="small mb-0 mt-3">Ce serai dommage de vous perdre sur cette plateforme.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    );
}

export default DeleteAccount;