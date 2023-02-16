/*this file currently only related to the home page and the changes made upon clicking login*/

class App extends React.Component 
{

/***********************************************************************
  * constructor
  * 
***********************************************************************/
	constructor(props) 
  {
    super(props);
    this.state = {center: <p></p>};

    this.setCenterLogin = this.setCenterLogin.bind(this);
    this.loginSubmit = this.loginSubmit.bind(this);
  }
/***********************************************************************
  * render
  * 
***********************************************************************/
  render() 
  {
    return (
    <div>
      <div class = "header">
  
      <nav>
        <ul class= "nav-links">
          <li><a href="admin.php">+ Add game</a></li>
          <li><a href="library.php">Library</a></li>
        </ul>

        <a href="home.php"><img src="css/NOOB_logo.png" alt="NOOB logo with a game controller" class="logo"/></a>
    
        <ul class= "nav-links">
          <li><a href="register.php">Register</a></li>
          
          <li><a onClick={this.setCenterLogin}>Login</a></li>
        </ul>
    
      </nav>
      </div>


      <div id="center">
        {this.state.center}

        <div class = "welcome">
          <p>Welcome to NOOB!</p><br/>
          <p>We are a video game review platform for noobs and pro gamers alike.</p>
        </div>

        <div class="hook">
          <h1>Find new games.</h1> <br/>
          <h1>Leave reviews.</h1> <br/>
          <h1>Meet other Noobs</h1> <br/>
          <h1>from all over the</h1> <br/>
          <h1>world!</h1> <br/>
        </div>

        <div class="welcome">
          <p>Begin your adventure with us today!</p>
        </div>

        <div class="image">
          <a href="register.php"><img src="css/start.png" alt="A button that says start on it" class="start"/></a>
        </div>
      </div> 

      </div>
    );
  }

/***********************************************************************
  * setCenterLogin
  * 
***********************************************************************/
  setCenterLogin()
  {
    this.setState(
      
      {center: 
      <div>
      <div id="darkOverlay">

      <div className="login">
      <h1>Login</h1>

      <form onSubmit={this.loginSubmit}>
        <label for="username">
              <i className="fas fa-user"></i>
        </label>
        <input type="text" id="username" name="username" placeholder="username" />
        <label for="password">
               <i className="fas fa-lock"></i> 
        </label>                 
        <input type="password" id="password" name="password" placeholder="**********" />
        <button type="submit">Login</button>
        </form>
      </div>

      </div>
      </div>

      }
    );  
  }

/***********************************************************************
  * loginSubmit
  * 
***********************************************************************/
  loginSubmit(e)
  {
    e.preventDefault();
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    this.checkUser(this, username, password); 
  }
/***********************************************************************
  * checkUser
  * 
***********************************************************************/   
  checkUser(that, uname, passwd) 
  {
    let myPromise = new Promise(function(myResolve, myReject) {
      let req = new XMLHttpRequest();
      req.open('POST', "controller_login.php", true);
      req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      req.onload = function() {
        if (req.status == 200) 
        {
          myResolve(req.response);
        } 
        else 
        {
          myReject("Database Error");
        }
      };
      let params = "action=login&username="+ uname + "&password=" + passwd +"";
      req.send(params);
      
    });
    
    myPromise.then(
      function(value) {that.loginStatus(value)},
      function(error) {that.loginStatus(error);} 
    );
  }
/***********************************************************************
* loginStatus
* 
***********************************************************************/
   loginStatus(statusMsg)
   {
      if (statusMsg.includes("1"))
      {
        this.setState(
        { center: 
          <div>
          <h1 className="welcome-text">Welcome back!</h1>
          </div>
        }
        ); 
        
        //redirect to profile page 
      }
      else
      {
        this.setState(
        { center: 
          <div>
          <h1 className="welcome-text">Login Error </h1>
          </div>
        }
        );  
        
      }
   }
}

ReactDOM.render(
  <App />,
  document.getElementById('main')
);

