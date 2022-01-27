import React, {useRef, useState} from 'react';
import UseFetch from "../Hooks/useFetch";
import {toast, ToastContainer} from "react-toastify";

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
function ForumSolve({message, topic, disable}) {
    const button = useRef(null);
    const {SetSolve, loading} = UseFetch("/api/solveMessage");
    const [disabled , setDisabled] = useState(disable);

    function handleClick() {
        SetSolve({
            message: message,
            topic: topic,
        });
        setDisabled(true);
        const messageElement = closest(button.current, '#forum-message')
        if (messageElement) {
            messageElement.classList.add('is-accepted')
        }
        toast("Le réponse a été approuvé", {
            position: "top-right",
            type: "success"
        })
    }

    return (
        <>
            <button
                ref={button}
                className='btn rounded-button success btn-sm'
                onClick={handleClick}
                disabled={disabled || loading}
                title='Répond à ma question !'
            >
                ✓
            </button>
            <ToastContainer/>
        </>
    );
}

function closest(element, selector) {
    for (; element && element !== document; element = element.parentNode) {
        if (element.matches(selector)) return element;
    }
    return null;
}

export default ForumSolve;