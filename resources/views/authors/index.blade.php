<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/style.css" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src="https://d3js.org/d3.v7.min.js"></script>
        <script src="/js/content.js"></script>
    </head>
    <!-- <header>
        <nav>
            <ul>
            <li class="app-name">WordBubbles</li>
            <li><a href="/authors/index">
                <span class="material-symbols-outlined">home</span>
                </a>
            </li>
            <li>
                <a href='/authors/create'>
                    <span class="material-symbols-outlined">add_circle</span>
                </a>
            </li>
            <li>
                <a href='/authors/delete-all'>
                    <span class="material-symbols-outlined">delete</span>
                </a>
            </li>
            </ul>
        </nav>
    </header> -->

<x-app-layout>
        <x-slot name="header">
        <nav>
            <ul>
            <!-- <li class="app-name">WordBubbles</li> -->
            <li><a href="/authors/index">
                <span class="material-symbols-outlined">home</span>
                </a>
            </li>
            <li>
                <a href='/authors/create'>
                    <span class="material-symbols-outlined">add_circle</span>
                </a>
            </li>
            <li>
                <a href='/authors/delete-all'>
                    <span class="material-symbols-outlined">delete</span>
                </a>
            </li>
            <li>
            </ul>
        </nav>
    </x-slot>
    <body>
        <div id="circle-container" width="2000" height="1000">
        
        <script>

        var width = 2000;
        var height = 1000;
        var svg = d3.select("#circle-container")
            .append("svg")
            .attr("width", width)
            .attr("height", height);

        var nodes = [];
        
        var authors = {!! json_encode($authors) !!}; // PHPの配列データをJavaScriptの配列に変換
        authors = authors['data'];
        for (var i = 0; i < authors.length; i++) {
            var author = authors[i];
            var circle = {
                x: Math.random() * 2000,
                y: Math.random() * 1000,
                r: author.count * 20,
                i: i,
                name: author.name,
            };
            nodes.push(circle);
        }
        var simulation = d3.forceSimulation(nodes)
            .force('center', d3.forceCenter().x(500).y(250))
            .force("charge", d3.forceManyBody().strength(500))  //反発力の設定
            .force('collision', d3.forceCollide().radius(function(d) {
                return d.r;
            }))
            .on('tick', ticked);
        
        function draw_circle() {
            var circles = svg.selectAll("circle")
                .data(nodes)
                .enter()
                .append("circle")
                .attr("cx", function(d) { return d.x; })
                .attr("cy", function(d) { return d.y; })
                .attr("r", function(d) { return d.r; })
                .attr("fill", "lightblue")
                .attr("font-color", "white")
                .on("click", function(d, e) {
                    var circle = d3.select(this);
                    console.log(circle);
                    var currentColor = circle.attr("fill");
                    var endColor = (currentColor === "lightblue") ? "blue" : "lightblue";
                    changeColor(circle, endColor);
                    //circle.attr("fill", endColor);
                    var texts = d3.selectAll("text");
                    var text = texts._groups[0][e.i].innerHTML;
                    // speakWord(text, e.name);
                    // texts._groups[0][e.i].innerHTML = (text === e.name) ? e.meaning : e.name;
                })
                .call(d3.drag().on("drag", dragCircle));
            
            var texts = svg.selectAll("text")
                .data(nodes)
                .enter()
                .append("text")
                .attr("x", function(d) { return d.x; })
                .attr("y", function(d) { return d.y; })
                .append("a")
                .attr("href", function(d) { return 'https://dl.acm.org/action/doSearch?AllField=' + encodeURIComponent(d.name); })
                .attr("text-anchor", "middle")  // テキストの水平位置を中央揃えに設定
                .attr("dy", ".35em")  // テキストの垂直位置を微調整
                .text(function(d) { return d.name; })
                .attr("font-size", function(d) { return d.r / 7; })
                .attr("font-family", "sans-serif")
                .attr("font-weight", "bold")
                .attr("fill", "white");
            
            simulation.alphaTarget(0.3).restart();
        }

        function changeColor(circle, endColor) {
            console.log(circle.attr("fill"));
            circle.transition()
                .duration(1000)
                .attrTween("fill", function() {
                    var startColor = circle.attr("fill");
                    return function(t) {
                        var interpolate = d3.interpolateHsl(startColor, endColor);
                        var currentColor = interpolate(t);
                        return currentColor;
                    };
                })
                .on("end", function() {
                    circle.attr("fill", endColor);
                });
            }

        function rotateColor(startColor, endColor) {

            return function(t) {
                var interpolate = d3.interpolateHsl(startColor, endColor);
                var currentColor = interpolate(t);
                d3.select(this).attr("fill", currentColor);

                var rotation = t * 360;
                d3.select(this).attr("transform", "rotate(" + rotation + ", 200, 200)");
            };
        }

        // function speakWord(text, word) {
        //     var msg = new SpeechSynthesisUtterance(text);
        //     if (text === word) {
        //         msg.lang = 'en-US';
        //     }
        //     else {
        //         msg.lang = 'ja-JP';
        //     }
        //     speechSynthesis.speak(msg);
        // }

        // シミュレーションの更新時に呼ばれる関数
        function ticked() {
            var circles = svg.selectAll("circle")
                .attr("cx", function(d) {
                    // 外枠にぶつかる場合は座標を調整する
                    if (d.x < d.r) {
                        d.x = d.r;
                    } else if (d.x > width - d.r) {
                        d.x = width - d.r;
                    }
                    if (d.y < d.r) {
                        d.y = d.r;
                    } else if (d.y > height - d.r) {
                        d.y = height - d.r;
                    }
                    return d.x;
                })
                .attr("cy", function(d) {
                    return d.y;
                });

            var texts = svg.selectAll("text")
                .attr("x", function(d) { return d.x; })
                .attr("y", function(d) { return d.y; });
        }

        function dragCircle(event, d) {
            d.x = event.x;
            d.y = event.y;
            d3.select(this)
                .attr("cx", d.x)
                .attr("cy", d.y);
        }

        function dragText(event, d) {
            d.x = event.x;
            d.y = event.y;
            d3.select(this)
                .attr("x", d.x)
                .attr("y", d.y);
        }

        draw_circle(); // 円を描画

        // function turnOver(element, name, meaning) {
        //     console.log(element.innerText);
        //     var linkElement = element.querySelector('a');
        //     if (linkElement.innerText === name) {
        //         linkElement.innerText = meaning;
        //         element.style.backgroundColor = 'blue';
        //         linkElement.style.color = 'white';
        //     } else {
        //         linkElement.innerText = name;
        //         element.style.backgroundColor = 'lightblue';
        //         linkElement.style.color = 'white';
        //     }
        // }

        </script>
        <!-- <script src="js/simulation.js"></script> -->
        </div>
    </body>
</x-app-layout>
</html>
