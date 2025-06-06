import {CreateGuesser, InputGuesser} from "@api-platform/admin";
import {RoastLevel} from "./RoastLevel";

export const CoffeeCreate = () => (
  <CreateGuesser>
    <InputGuesser source="id" />
    <InputGuesser source="roaster" />
    <InputGuesser source="name" />
    <InputGuesser source="origin" />
    <InputGuesser source="roastLevel" />
  </CreateGuesser>
);
