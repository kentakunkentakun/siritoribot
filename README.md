# siritoribot
- セルフしりとりをサポートしてくれるLINEbotです。
- しりとりを開始するときは「しりとり始め」と打ってください。
- しりとりを終了するときは　「しりとり終了」と打ってください。
## ファイルについて
```bash
siritoribot
├── index.php    : LINEBOTにメッセージが送られた際、userIdとテキストを受け取る。
├── sql.php    : 送られてきたテキストをPostgreSQLに登録、重複確認等を行う。
├── sukure.php    : 送られてきたテキストの意味をhttps://www.weblio.jp/content/にて検索し、内容をスクレイピングしてとってくる。(phpQuery)
```

![siritoribotQR](https://user-images.githubusercontent.com/65205373/108872358-70a6e300-763d-11eb-8812-e15dd90c997b.png)
