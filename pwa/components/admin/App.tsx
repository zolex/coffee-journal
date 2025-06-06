import {HydraAdmin, ResourceGuesser} from "@api-platform/admin";
import {CoffeeEdit} from "./Coffee/CoffeeEdit";
import {CoffeeCreate} from "./Coffee/CoffeeCreate";
import {CoffeeList} from "./Coffee/CoffeeList";
import {Layout} from 'react-admin';
import {JournalCreate} from "./Journal/JournalCreate";
import {JournalEdit} from "./Journal/JournalEdit";
import {JournalList} from "./Journal/JournalList";
import {RatingList} from "./Ratings/RatingList";

const App = () => (
  <HydraAdmin
    entrypoint={window.origin}
    title="Coffee JOURNAL"
    layout={Layout}
  >
    <ResourceGuesser name="journals" list={JournalList} edit={JournalEdit} create={JournalCreate} />
    <ResourceGuesser name="roasters" />
    <ResourceGuesser name="coffees" list={CoffeeList} edit={CoffeeEdit} create={CoffeeCreate} />
    <ResourceGuesser name="coffee_beans" />
    <ResourceGuesser name="coffee_types" />

    <ResourceGuesser name="origins" />
    <ResourceGuesser name="roast_levels" />
    <ResourceGuesser name="bean_types" />
    <ResourceGuesser name="ratings" list={RatingList} />
  </HydraAdmin>
);

export default App;
