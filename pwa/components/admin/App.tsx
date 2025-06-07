import {HydraAdmin, ResourceGuesser} from "@api-platform/admin";
import {CoffeeEdit} from "./Coffee/CoffeeEdit";
import {CoffeeCreate} from "./Coffee/CoffeeCreate";
import {CoffeeList} from "./Coffee/CoffeeList";
import {Layout} from 'react-admin';
import {JournalCreate} from "./Journal/JournalCreate";
import {JournalEdit} from "./Journal/JournalEdit";
import {JournalList} from "./Journal/JournalList";
import {RatingList} from "./Ratings/RatingList";
import {RecipeList} from "./Recipes/RecipeList";
import {RecipeShow} from "./Recipes/RecipeShow";

const App = () => (
  <HydraAdmin
    entrypoint={window.origin}
    title="Coffee JOURNAL"
    layout={Layout}
  >
    <ResourceGuesser name="journals" list={JournalList} edit={JournalEdit} create={JournalCreate} />
    <ResourceGuesser name="roasters" />
    <ResourceGuesser name="coffees" list={CoffeeList} edit={CoffeeEdit} create={CoffeeCreate} />
    <ResourceGuesser name="recipes" list={RecipeList} show={RecipeShow} />
    <ResourceGuesser name="origins" />

    <ResourceGuesser name="roast_levels" />
    <ResourceGuesser name="bean_types" />
    <ResourceGuesser name="ingredients" />
    <ResourceGuesser name="ratings" list={RatingList} />
    {/* <ResourceGuesser name="coffee_beans" /> this is now included in coffees */}
  </HydraAdmin>
);

export default App;
