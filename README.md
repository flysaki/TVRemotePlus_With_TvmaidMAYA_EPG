# TVRemotePlus_With_TvmaidMAYA_EPG

[tsukumijima/TVRemotePlus](https://github.com/tsukumijima/TVRemotePlus) 用 ~~EDCB~~TvmaidMAYA番組情報取得パッチ

- 試験段階
- 改造前にバックアップを取ってください

## 概要
- TVMaidMAYAから番組情報を取得（EDCB環境は不要となる）
- TVRemotePlusリリース版のスクリプト改造で実現（ビルドなど不要）
- 現段階はコード差分のみ公開

### DONE / TODO
- [x] 放送中番組の情報取得
- [ ] 次の番組の情報取得
- [ ] 放送休止などの判定

## 技術概要

基本的にTVRemotePlusの既存PHP環境をそのまま利用。Apache / PHP 環境設定の変更はありません。

### フロー
- TVRemotePlus（EPG取得APIのPHPスクリプト改造） 
- ↓　↑
- TVMaidMAYAEPG取得Class（PHPスクリプト新規作成）
- ┗SQLite PDO
- 　↓　↑
- TVMaidMAYA EPGデータベース（ファイルシステム）
- （パス指定要：`new PDO('sqlite:./PATH/TO/TvmaidMAYA/user/tvmaid-5.db')`）

# 使用方法
リリース版導入、チャンネル取得、視聴動作確認をした上で
1. 繰り返しますが、バックアップを取りましょう
2. TVRemotePlusを起動
3. [ソース差分](https://github.com/flysaki/TVRemotePlus_With_TvmaidMAYA_EPG/commit/ff8610569a631c3b8a32622df7d04c18ffe23784)を確認し、自分のマシーン上のソースを改造
4. ブラウザ再読込（F5）を行い動作確認
