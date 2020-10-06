// Part 1a
function part1aRecurse(elem, prefix) {
    let children = elem.childNodes;
    let str = "";
    str += prefix + elem.tagName + '\n';
    if (children) {
        for (var i = 0; i < children.length; i++) {
            if (children[i].nodeName != '#text')
                str += part1aRecurse(children[i], prefix + '-');
        }
    }
    return str;
}

function part1a() {
    var str = '';
    let elem = document.getElementsByTagName('html')[0];
    str = part1aRecurse(elem, '');
    document.getElementById("info").innerHTML = str;
}

// Part 2
function part2Recurse(elem) {
    let children = elem.childNodes;
    if (children) {
        for (var i = 0; i < children.length; i++) {
            if (children[i].nodeName != '#text') {
                children[i].addEventListener('click', function(e) {
                    alert(e.currentTarget.tagName);
                });
                part2Recurse(children[i]);
            }
        }
    }
}

function part2() {
    let elem = document.getElementsByTagName('html')[0];
    part2Recurse(elem);
}