import {HydraAdmin, ResourceGuesser} from "@api-platform/admin";
import {CoffeeEdit} from "./CoffeeEdit";
import {CoffeeCreate} from "./CoffeeCreate";
import {CoffeeList} from "./CoffeeList";

const App = () => (
  <HydraAdmin
    entrypoint={window.origin}
    title="Coffee JOURNAL"
  >
    <ResourceGuesser name="roasters" />
    <ResourceGuesser name="coffees" list={CoffeeList} edit={CoffeeEdit} create={CoffeeCreate} />
    <ResourceGuesser name="coffee_beans" />

    <ResourceGuesser name="origins" />
    <ResourceGuesser name="roast_levels" />
    <ResourceGuesser name="bean_types" />
  </HydraAdmin>
);

export default App;
