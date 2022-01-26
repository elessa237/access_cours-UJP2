import React from "react";
import {render, unmountComponentAtNode} from "react-dom";
import ForumSolve from "../forum/ForumSolve";

class forumSolve extends HTMLElement{

    connectedCallback(){
        const topicAuthorId = parseInt(this.getAttribute("topic-author"), 10);
        const messageId = parseInt(this.getAttribute("message"), 10);
        const disable = this.getAttribute("disabled")

        render(<ForumSolve message={messageId} topic={topicAuthorId} disable={disable}/>, this);
    }

    disconnectedCallback(){
        unmountComponentAtNode(this);
    }
}

export default forumSolve;