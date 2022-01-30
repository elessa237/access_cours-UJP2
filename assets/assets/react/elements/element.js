import courElement from "./courElement";
import {TimeAgo} from "./TimeAgo";
import forumSolve from "./forumSolve";
import settingsElement from "./settingsElement";

customElements.define('cours-pdf', courElement);
customElements.define('time-ago', TimeAgo);
customElements.define("forum-solve", forumSolve);
customElements.define('profil-settings', settingsElement);