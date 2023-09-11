
function ajax(url, method, data, elem_class) {
    $.ajax({
        url: url,
        method: method,
        data: data,
        success: function(html) {
            console.log(1);
            $(elem_class).html(html);
        },
        error: function(er) {
            console.log(er);
        }
    });
}



class Action {

    event_name;

    constructor(elem) {
        this._elem = elem;
        elem.onclick = this.onClick.bind(this); // (*)
    }

    start() {
        window.location.href = '/game';
        return false;
    }

    move() {
        let url = '/move';
        let method = "post";
        let data = {
            "action": this.event_name,
        };
        let elem_class = ".game-info";
        return ajax(url ,method, data, elem_class);
    }


    onClick(event) {
        let action = event.target.dataset.action;
        this.event_name = event.target.name;
        if (action) {
            this[action]();
        }
    }
}

let action_menu = document.querySelector(".action-menu");
if (action_menu) {
    new Action(action_menu);
}
