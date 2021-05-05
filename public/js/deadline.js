addEventListener("load", function () {//Show Deadline
    let urgecySelect = document.querySelector("#urgency");
    urgecySelect.addEventListener("change", function () {
        showDeadline();
    })

    function showDeadline() {
        let deadlineMessage = document.querySelector("#deadlineMessage");
        deadlineMessage.style.display = "block";
        deadlineMessage.innerHTML = "Werkzeug wieder erhältlich am: " + getDeadline(urgecySelect.options[urgecySelect.selectedIndex].value);
    }

    function getDeadline(urgency) {
        let duration = 0
        let date = new Date()
        switch (urgency) {
            case "1":
                duration = 25;
                break;
            case "2":
                duration = 20;
                break;
            case "3":
                duration = 15;
                break;
            case "4":
                duration = 10;
                break;
            case "5":
                duration = 5;
                break;
        }
        date.setDate(date.getDate() + duration)
        return formatDate(date)
    }

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [day, month, year].join('-');
    }

    showDeadline();
})