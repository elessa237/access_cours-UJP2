import React, {useRef, useState} from 'react';
import UseFetch from "../Hooks/useFetch";

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
function ForumSolve({message, topic, disable}) {
    const button = useRef(null);
    const {solveResponse,SetSolve, loading} = UseFetch("/api/solveMessage");
    const [disabled , setDisabled] = useState(disable);

    function handleClick() {
        console.log(message)
        SetSolve({id: message});
        setDisabled(true);
        const messageElement = closest(button.current, '#forum-message')
        if (messageElement) {
            messageElement.classList.add('is-accepted')
        }
    }

    return (
        <button
            ref={button}
            className='btn rounded-button success btn-sm'
            onClick={handleClick}
            disabled={disabled || loading}
            title='Répond à ma question !'
        >
            ✓
        </button>
    );
}

function closest(element, selector) {
    for (; element && element !== document; element = element.parentNode) {
        if (element.matches(selector)) return element;
    }
    return null;
}

export default ForumSolve;