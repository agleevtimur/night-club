import React from "react"
import Start from "./component/Start";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import Room from "./component/room/Room";

const applyDarkMode = () => {
  const link = document.createElement("link")
  link.rel = "stylesheet"
  link.id = "antd-stylesheet"
  link.href = "https://cdnjs.cloudflare.com/ajax/libs/antd/4.9.4/antd.dark.min.css"
  document.head.appendChild(link)
}

applyDarkMode();

const App = () => <Router>
  <Switch>
    <Route path="/room">
      <Room/>
    </Route>
    <Route path="/">
      <Start />
    </Route>
  </Switch>
</Router>;

export default App
