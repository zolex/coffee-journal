import {ListGuesser, FieldGuesser} from "@api-platform/admin";

export const CoffeeList = () => (
  <ListGuesser>
    <FieldGuesser source="roaster" />
    <FieldGuesser source="name" />
    <FieldGuesser source="roastLevel" />
    <FieldGuesser source="beans" />
  </ListGuesser>
);
