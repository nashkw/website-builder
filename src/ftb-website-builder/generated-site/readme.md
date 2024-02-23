# Your website

These files are a copy of the website you created using Website Builder by [freetobook](https://en.freetobook.com/). They can be used to run your website as a standalone application and require no interfacing with the Website Builder application. To make use of these files you will need some technical ability and familiarity with the theory behind deploying a web application.



## Project structure

This project follows a typical [Vue app structure](https://worldline.github.io/vuejs-training/views/).

* `assets/` the CSS classes used throughout your website
* `components/` the reusable Vue components used throughout your website
* `data/` the data (`data.json`) and images (`data/images/`) used in your website
* `pages/` the Vue components for each of the pages in your website
* `router/` the [Vue Router](https://router.vuejs.org/introduction.html) used to map URLs to pages
* `stores/` the [Pinia Store](https://pinia.vuejs.org/introduction.html) used to populate the pages with data
* `views/` the intermediary Vue components used to funnel data from the store into pages



## How to run your website locally

### Install pre-requsite technologies

* You will need to install Node.js, a JavaScript runtime environment.
    * The latest LTS version can be downloaded [here](https://nodejs.org/en/download).
    * This will automatically install the NPM command line interface as well.
* If you plan to edit the code for your website you will need an IDE that can open `.js`, `.vue`, and `.json` files.
    * One option is using [VSCode](https://code.visualstudio.com/) with the [Volar](https://marketplace.visualstudio.com/items?itemName=Vue.volar) extension.

### Create environment variables

* Navigate to the folder which contains this website.
* Create a new file named `.env`. This will contain the environment variables needed for this project.
* If your website does not contain a Find Us page you can ignore the following steps.
    * Your Find Us page will still display if you do not follow these instructions.
    * However, if you want the Google Maps embed at the bottom of the page to display you will need to generate an API key.
    * You can do this by following the instructions [here](https://developers.google.com/maps/documentation/embed/quickstart#create-project).
    * This will involve creating a Google Cloud account and entering billing information.
    * However, your account will not be charged a this API is free to use.
    * Add `VITE_GOOGLE_MAPS_API_KEY="maps_api_key"` to your `.env` file (where `maps_api_key` is replaced with your API key).

### Run the application

* Open your preferred command line interface and navigate to the folder which contains this website.
    * On Linux you can do this by opening the folder, clicking the three dots in the menu bar, and selecting `Open in Terminal`.
    * On Windows you can do this by clicking in the address bar, typing `cmd`, then pressing `Enter`.
* Install all necessary JavaScript packages by running the `npm install` command.
* Run your website by running the `npm run dev` command.
* In your preferred web browser, navigate to `http://127.0.0.1:8000` to see your website.
* Your website is now available locally (on your machine). It will not be accessible to anyone on another machine.
* To stop running your website either close the command line interface or press `CTRL+C` inside it.
* To run your website after this initial setup you need only navigate to the folder which contains this website and run the `npm run dev` command.



## How to make your website available on the internet

* To make your website available on the internet you will need to host it from an external platform.
* The Vue CLI documentation has a [helpful guide](https://cli.vuejs.org/guide/deployment.html#platform-guides) on how this can be done using various popular platforms.
* If you want your website to be available at a custom domain you will first need to own that domain.
    * If you need to acquire a domain [this](https://www.forbes.com/uk/advisor/business/software/best-domain-registrar/) Forbes article gives a brief overview of how different domain name registrars comapre.
* You will then need to connect your domain to your hosted website.
    * How exactly you can do this will depend on which hosting service and domain name registrar you are using.
    * This will involve updating your DNS records (found in your domain name registrar account) with your nameserver (determined by your hosting service).
