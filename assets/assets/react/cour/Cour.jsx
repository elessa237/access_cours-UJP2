import React, {useEffect} from 'react';
import Card from "./Card";
import useFetch from "../Hooks/useFetch";
import Spinner from "../components/Spinner";

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
function Cour({user}) {

    const {cour: cours, load, loading} = useFetch("/api/cour/"+user);

    useEffect(()=>{
        load()
    }, [])

    return (
        <div className="row">
            {loading && <Spinner />}
            {cours.map((cour, key) =>
                <Card key={key} cour={cour} />
            )}
        </div>
    );
}

export default Cour;