import React, {useCallback, useState} from 'react';
import axios from "axios";

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
function UseFetch(url) {
    const [cour, setCour] = useState([]);
    const [loading, setLoading] = useState(false);

    const load = useCallback(
        async () => {
            setLoading(true)
            axios.get(url)
                .then(response => {
                    setCour(response.data)
                    setLoading(false)
                })
        },
        [url]
    );

    return{
        cour,
        load,
        loading
    }
}

export default UseFetch;