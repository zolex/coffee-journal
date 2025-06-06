import {ListGuesser, FieldGuesser} from "@api-platform/admin";
import React from "react";

export const JournalList = () => (
  <ListGuesser>
    <FieldGuesser source="type" />
    <FieldGuesser source="coffee" />
    <FieldGuesser source="rating" />
    <FieldGuesser source="date" />
  </ListGuesser>
);
