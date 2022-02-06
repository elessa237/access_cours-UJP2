import React, {useEffect, useState} from 'react';
import Card from "./includes/Card";
import useFetch from "../Hooks/useFetch";
import Spinner from "../components/Spinner";
import EmptyDoc from "./includes/EmptyDoc";

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
function Cour() {

    const {ue: ues, getAll, loading: loadingUe} = useFetch("/api/ue");
    const {cour: cours, FilterPost, loading} = useFetch("/api/cour/filter")

    const [value, setValue] = useState("");

    function handleChange(e) {
        const value = e.target.value
        FilterPost({id: value});
        setValue(e.target.value);
    }

    useEffect(() => {
        FilterPost({id: value});
        getAll();
    }, [])


    return (
        <>
            <div className="col-lg-3 offset-lg-9 col-md-4 offset-md-8 col-sm offset-4 text-center">
                <select className="form-control" onChange={handleChange} value={value}>
                    <option value="">--- Sélectionné l'U.E ---</option>
                    {ues.map((ue, key) => <option value={ue.id} key={key}>{ue.nom}</option>)}
                </select>
            </div>
            <div className="row">
                {
                    loading || loadingUe ?
                        <div style={{marginTop: "250px"}}>
                        <Spinner/>
                        </div>:
                        cours.length > 0 ?
                        cours.map((cour, key) =>
                            <Card key={key} cour={cour}/>) :
                            <EmptyDoc />
                }
            </div>
        </>
    );
}

export default Cour;