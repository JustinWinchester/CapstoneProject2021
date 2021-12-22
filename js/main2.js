let id = $("input[name*='student_id']")
id.attr("readonly", "readonly");


$(".btnedit").click(e => {
    let textvalues = displayData(e);

    ;
    let studentname = $("input[name*='student_name']");
    let studentcourse = $("input[name*='student_course']");
    let studentmajor = $("input[name*='student_major']");

    id.val(textvalues[0]);
    studentname.val(textvalues[1]);
    studentcourse.val(textvalues[2]);
    studentmajor.val(textvalues[3].replace("$", ""));
});


function displayData(e) {
    let id = 0;
    const td = $("#tbody tr td");
    let textvalues = [];

    for (const value of td) {
        if (value.dataset.id == e.target.dataset.id) {
            textvalues[id++] = value.textContent;
        }
    }
    return textvalues;

}