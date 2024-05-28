# WordBubbles
※ デプロイ済みですが、Database使用の無料期間が終了したため、[アプリのサイト](https://wordbubbles.herokuapp.com/words/index)を開くとエラーが表示されます。
## 概要
WordBubblesは、Webページ上で学習した英単語を保存し、別のWebページ上で可視化するアプリです。 
Webページ上の英単語をダブルクリックするとポップアップで意味を表示してくれる[Google Dictionaryの拡張機能](https://chromewebstore.google.com/detail/google-dictionary-by-goog/mgijmajocgfcbeboacabfgobmjgjcoja?hl=en)と併用することを想定しており、ダブルクリックされた英単語をサーバに送信し、[別のWebページ](https://wordbubbles.herokuapp.com/words/index)上で、それらの単語をバブル状に可視化します。  
複数回ダブルクリックされた英単語は、出現頻度が高いのにも関わらず、定着していない可能性があり、優先的に暗記する必要があると考えられるので、大きく可視化しています。  

**使用方法**
1. [本アプリ用のChrome拡張機能](https://github.com/reireirei1221/WordBubbles_Extension_word.git)をダウンロードし、拡張機能に追加します。
2. 英単語を含む任意のWebページを開きます。
3. 開いたWebページ上の任意の英単語をダブルクリックします。
4. [アプリのサイト](https://wordbubbles.herokuapp.com/words/index)を開きます。
5. ダブルクリックされた英単語が、その回数に応じたサイズで表示されています。
6. また、可視化された各単語をクリックすると、その単語を英英辞書で検索します。

## 追加実装
また、上の機能をもとに、論文の著者名を可視化する機能を追加で実装しました。  
ACM Library内の論文に対する自分の興味を5段階で評価すると、自分の評価が高い論文に共通して含まれる著者の名前が大きく可視化されます。

**使用方法**
1. [本アプリ用のChrome拡張機能](https://github.com/reireirei1221/WordBubble_Extension_author.git)をダウンロードし、拡張機能を追加します。
2. ACM Library内の論文のWebページを一つ開きます。 (ex. https://dl.acm.org/doi/10.1145/3526114.3558708)
3. 先にダウンロードしたchrome拡張機能のアイコンをクリックし、論文に対する自分の興味を5段階で評価し、送信を押します。
4. [アプリのサイト](https://wordbubbles.herokuapp.com/authors/index)を開きます。
5. 自分の評価が高い論文に共通して含まれる著者の名前が、大きく表示されています。
6. また著者名をクリックすると、その著者が執筆した論文をACM Library内で検索します。

## 必要な環境
- インターネット接続環境
- 対応するウェブブラウザ (Google Chrome)
