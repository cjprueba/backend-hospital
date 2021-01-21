import React, {Component} from "react";
import ReactDom from "react-dom";

import Register from "./user/Register.js";
import Home from "./Home.js";

import {
	BrowserRouter as Router,
	Switch,
	Route
} from "react-router-dom";

function Main() {
	return (
			<Router>
				<main>
						<Switch>
							<Route path="/home" exact component={Home}/>
							<Route path="/user/register" exact component={Register}/>
						</Switch>
				</main>
			</Router>
		)
}

export default Main
ReactDom.render(<Main />, document.getElementById('main-hospital'));
