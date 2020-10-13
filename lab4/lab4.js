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

// Part 1b
function part1b() {
    var i;
    var str = '';
    var prefix = '';
    var classNameArr = ['html', 'head', 'title', 'link', 'script', 
        'body', 'h1', 'pre', 'part1b',
        'q1', 'q2', 'q3', 'q4'];
    for (i = 0; i < classNameArr.length; i++) {
        cName = classNameArr[i];
        if (cName == "head" || cName == "body") {
            prefix = '-';
            str += prefix + document.getElementsByClassName(cName)[0].tagName + '\n';
        }
        else if ((i >= 6 && i <= 8) || (i >= 1 && i <= 3)) {
            prefix = '--';
            str += prefix + document.getElementsByClassName(cName)[0].tagName + '\n';
        }
        else if (i >= 9 && i <= 12) {
            prefix = '--';
            str += prefix + document.getElementsByClassName(cName)[0].tagName + '\n';
            let children = document.getElementsByClassName(cName)[0].childNodes;
            if (children) {
                prefix = '---';
                for (var j = 0; j < children.length; j++) {
                    if (children[j].nodeName != '#text')
                        str += prefix + children[j].tagName + '\n';
                }
            }
        }
        else {
            str += prefix + document.getElementsByClassName(cName)[0].tagName + '\n';
        }
    }
    console.log(str);
    document.getElementById("part1b").innerHTML = str;
    return;
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

// Part 3
window.addEventListener('load', (event) => {
    var item = document.getElementsByTagName("body")[0].lastElementChild;
    var quote = item.cloneNode(true);
    quote.innerHTML = "<h2>OUR FAVORITE QUOTE!!!</h2><p>\"Your time is limited, so don't waste it living someone else's life. Don't be trapped by dogma - which is living with the results of other people's thinking.\" - Steve Jobs</p>";
    document.getElementsByTagName("body")[0].appendChild(quote);

    var divs = document.getElementsByTagName("div");
    for (var i = 0; i < divs.length; i++) {
        divs[i].addEventListener('mouseover', function() {
            this.style.backgroundColor = 'var(--main-light)';
            this.style.marginLeft = '10px';
        });
        divs[i].addEventListener('mouseout', function() {
            this.style.backgroundColor = '';
            this.style.marginLeft = '0';
        });
    }

    part1a();
    part1b();
    part2();
});