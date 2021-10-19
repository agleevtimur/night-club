import React from "react";
import { render } from "react-dom";
import App from "./App";
import "./index.css";
import { createStore } from 'redux';
import reducer from './redux/reducer/index.js';
import { Provider } from "react-redux";


const store = createStore(reducer, window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__() );

render(
    <Provider store={store}>
        <App />
    </Provider>,
    document.getElementById("root")
);
