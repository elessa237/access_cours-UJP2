import React from 'react';

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
function Card({cour}) {
    const date = new Date(cour.publishedAt);
    return <div className="col-lg-3 col-md-6 col-sm-12 mt-6">
        <div className="card">
            <img src="/images/img-pdf.png" className="card-img-top d-flex justify-content-center" style={{height: "100px", width: "100px"}} alt="..."/>
            <div className="card-body">
                <h5 className="card-title">{cour.nom} | {cour.UE.nom}</h5>
                <a className="float-end btn-lg" href={"/documents/cours/" + cour.nomCour} download><i className="fa fa-download text-secondary"/></a>
                <p className="card-text">
                    Ajouté le {date.toLocaleString(undefined, dateFormat)} <br/>
                    taille : {convertedSize(cour.tailleCour)}Mo</p>
            </div>
        </div>
    </div>;
}

function convertedSize(docSize) {
    return Number.parseFloat(docSize * 0.000000953674316).toPrecision(2);
}

const dateFormat = {
    dateStyle : 'medium',
    timeStyle : 'short'
}
export default Card;