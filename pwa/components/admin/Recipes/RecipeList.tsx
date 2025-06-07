import {ListGuesser, FieldGuesser} from "@api-platform/admin";

export const RecipeList = () => (
  <ListGuesser>
    <FieldGuesser source="name" />
    <FieldGuesser source="info" />
    <FieldGuesser source="ingredients" />
    <FieldGuesser source="rating" />
  </ListGuesser>
);
