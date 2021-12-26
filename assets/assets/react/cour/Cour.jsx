import React, {useEffect, useState} from 'react';
import Card from "./Card";
import useFetch from "../Hooks/useFetch";
import Spinner from "../components/Spinner";

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
            <div className="col-3 offset-9 text-center">
                <select className="form-control" onChange={handleChange} value={value}>
                    <option value="">--- Sélectionné l'U.E ---</option>
                    {ues.map((ue, key) => <option value={ue.id} key={key}>{ue.nom}</option>)}
                </select>
            </div>
            <div className="row">
                {
                    loading || loadingUe ? <Spinner/> :
                        cours.map((cour, key) =>
                            <Card key={key} cour={cour}/>)
                }
            </div>
        </>
    );
}

export default Cour;