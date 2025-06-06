import {EditGuesser, InputGuesser} from "@api-platform/admin";
import {RoastLevel} from "./RoastLevel";

export const CoffeeEdit = () => (
  <EditGuesser>
    <InputGuesser source="id" />
    <InputGuesser source="roaster" />
    <InputGuesser source="name" />
    <InputGuesser source="origin" />
    <InputGuesser source="roastLevel" />
    <InputGuesser source="rating" />
  </EditGuesser>
);
