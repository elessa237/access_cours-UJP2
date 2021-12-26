import React, {useCallback, useState} from 'react';
import axios from "axios";

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
function UseFetch(url) {
    const [cour, setCour] = useState([]);
    const [ue, setUe] = useState([]);
    const [loading, setLoading] = useState(false);

    const getAll = useCallback(
        async () => {
            setLoading(true)
            axios.get(url)
                .then(response => {
                    setUe(response.data.ues)
                    setLoading(false)
                })
        },
        [url]
    );

    const FilterPost = useCallback(
        async (data) => {
            setLoading(true)
            axios.post(url, data).then(response => {
                setCour(response.data)
                setLoading(false)
            }).catch((error) => {
                console.error(error)
                setLoading(false)
            })
        },[url]
    )

    return{
        cour,
        ue,
        getAll,
        FilterPost,
        loading
    }
}

export default UseFetch;