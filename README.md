# WordBubbles

## 概要
WordBubblesは、Webページ上で得た情報を、隙間時間に復習するために作られたアプリです。
大きく以下の二つの機能があります。
### Webページ上の英単語をダブルクリックする回数に応じて、その単語を大きく表示する機能
ダブルクリックした単語はChrome拡張機能によって取得しています。Webページ上の英単語をダブルクリックすると意味を表示してくれる、Google Dictionaryの拡張機能と併用することを想定しており、複数回意味を確認する単語は出現頻度が高いのにも関わらず、定着していないので優先的に暗記する必要があると判断し、大きく可視化しています。

**使用方法**
1. 本アプリ用のChrome拡張機能 (https://github.com/reireirei1221/WordBubbles_Extension_word.git) をダウンロードし、拡張機能を追加します。
2. 英単語が含まれる任意のWebページを開きます。
3. Webページ上の英単語をダブルクリックします。
4. これを複数回繰り返します。
5. アプリのサイト (https://wordbubbles.herokuapp.com/words/index) を開きます。
6. ダブルクリックした単語が、その回数に応じて大きく表示されます。
7. また単語をクリックすると、その単語を英英辞典で検索します。
### ACM Library内の論文を5段階で評価し、今まで読んだ論文の中で、自分の中の評価が高い著者大きく表示する機能

**使用方法**
1. 本アプリ用のChrome拡張機能 (https://github.com/reireirei1221/WordBubble_Extension_author.git) をダウンロードし、拡張機能を追加します。
2. ACM Library内の論文を一つ開きます。 (ex. https://dl.acm.org/doi/10.1145/3526114.3558708)
3. 先にダウンロードしたchrome拡張機能のアイコンをクリックし、論文を5段階で評価し、送信を押します。
4. これを複数の論文ページに対して繰り返します。
5. アプリのサイト (https://wordbubbles.herokuapp.com/authors/index) を開きます。
6. 自分の評価が高い著者が、大きく表示されます。
7. また著者名をクリックすると、その著者をACM Library内で検索します。
## 今後の設計方針
今後は、さらに論文ページ以外のWebコンテンツ (Youtubeなど) の評価を記録していき、友人や家族と共有できるような機能を追加しようと思っております。
また、フロントエンドが未完成になっております。

## 必要な環境
- インターネット接続環境
- 対応するウェブブラウザ (Google Chrome)

## ライセンス
このアプリはMITライセンスの下で提供されています。詳細については、LICENSEファイルを参照してください。
