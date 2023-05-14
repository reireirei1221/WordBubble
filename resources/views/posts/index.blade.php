<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/style.css" >
        <script src="https://d3js.org/d3.v7.min.js"></script>
        <script src="/js/content.js"></script>
    </head>
    <header>
        <nav>
            <ul>
            <li><a href="/">Home</a></li>
            <li><a href="#">メニュー2</a></li>
            <li><a href='/posts/create'>Add</a></li>
            </ul>
        </nav>
    </header>
    <body>
        <!-- <h1>Remember！</h1>
        <a href='/posts/create'>Add</a> -->
        <div>
            @foreach ($posts as $post)
                <div class="circle" style='--circle-size: {{ $post->count * 80 }}px; --font-size: {{ $post->count * 10 }}px' onclick="turnOver(this, '{{ $post->name }}', '{{ $post->meaning }}')">
                    <!-- <p style='font-size: {{ $post->count * 10}}px;'> -->
                        <a href="/posts/{{ $post->id }}">
                            <span class="text">
                                {{ $post->name }}
                            </span>
                        </a>
                    <!-- </p> -->
                </div>
            @endforeach
        </div>
        <div>
            {{ $posts->links() }}
        </div>
        <div id="circle-container" width="2000" height="1000">
        <script src="js/content.js">
        </script>
        <!-- @foreach ($posts as $post)
            <script>
                draw_circle({{ $post->count * 50 }});
            </script>
        @endforeach -->
        <script>

        var width = 2000;
        var height = 1000;
        var svg = d3.select("#circle-container")
            .append("svg")
            .attr("width", width)
            .attr("height", height);

        var nodes = [];
        
        var posts = {!! json_encode($posts) !!}; // PHPの配列データをJavaScriptの配列に変換
        posts = posts['data'];
        for (var i = 0; i < posts.length; i++) {
            var post = posts[i];
            var circle = {
                x: Math.random() * 2000,
                y: Math.random() * 1000,
                r: post.count * 50,
                name: post.name,
            };
            nodes.push(circle);
        }
        var simulation = d3.forceSimulation(nodes)
            .force('center', d3.forceCenter().x(1000).y(500))
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
                .attr("fill", "red")
                .attr("text", function(d) { return d.name; })
                .attr("font-size", function(d) { return d.r / 10; })
                .attr("font-color", "white");
        }

        // シミュレーションの更新時に呼ばれる関数
        function ticked() {
            var circles = svg.selectAll("circle")
                .attr("cx", function(d) { return d.x; })
                .attr("cy", function(d) { return d.y; });
        }

        draw_circle(); // 円を描画

        function turnOver(element, name, meaning) {
            console.log(element.innerText);
            var linkElement = element.querySelector('a');
            if (linkElement.innerText === name) {
                linkElement.innerText = meaning;
                element.style.backgroundColor = 'blue';
                linkElement.style.color = 'white';
            } else {
                linkElement.innerText = name;
                element.style.backgroundColor = 'lightblue';
                linkElement.style.color = 'white';
            }
        }

        </script>
        <!-- <script src="js/simulation.js"></script> -->
</div>

    </body>
</html>
