import React, {useCallback, useState} from 'react';
import axios from "axios";

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
function UseFetch(url) {
    const [cour, setCour] = useState([]);
    const [ue, setUe] = useState([]);
    const [loading, setLoading] = useState(false);
    const [solveResponse, SetSolveResponse] = useState("");
    const [data, setData] = useState({});

    const getAll = useCallback(
        async () => {
            setLoading(true)
            axios.get(url)
                .then(response => {
                    setUe(response.data.ues)
                    setLoading(false)
                })
        }, [url]
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

    const SetSolve = useCallback(
        async (data) => {
            setLoading(true)
            axios.post(url, data).then(response => {
                SetSolveResponse(response.data)
                setLoading(false)
            }).catch((error) => {
                console.error(error)
                setLoading(false)
            })
        }, [url]
    )

    const postData = useCallback(
        async (data) => {
            setLoading(true)
            axios.post(url, data).then(response => {
                setData(response.data)
                setLoading(false)
            }).catch((error) => {
                console.error(error)
                setLoading(false)
            })
        }, [url]
    )

    return{
        cour,
        ue,
        getAll,
        FilterPost,
        SetSolve,
        solveResponse,
        postData,
        data,
        loading
    }

}

export default UseFetch;